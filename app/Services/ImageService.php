<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function saveImagesFromContent($content)
    {

        if (mb_detect_encoding($content, 'UTF-8', true) === false) {
            $content = mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content));
        }

        libxml_use_internal_errors(true);

        $dom = new \DomDocument();
        //dd($content);
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        libxml_clear_errors();

        $imageFile = $dom->getElementsByTagName('img');
        $imageSources = [];

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (strpos($data, 'data:image') === 0) {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $imageData = base64_decode($data);
                $imageName = time() . $item . '.png';
                $path = 'images/' . $imageName;
                Storage::disk('public')->put($path, $imageData);
                $image->removeAttribute('src');
                $image->setAttribute('src', Storage::url($path));
                $imageSources[] = Storage::url($path);
            } else {
                $imageSources[] = $data;
            }
        }

        return [
            'content' => $dom->saveHTML(),
            'imageSources' => $imageSources
        ];
    }

    public function deleteUnusedImages($oldImageSources, $newImageSources)
    {
        foreach ($oldImageSources as $oldImageSource) {
            if (!in_array($oldImageSource, $newImageSources)) {
                unlink(public_path($oldImageSource));
            }
        }
    }

    public function cleanAndValidateHtml($content) {
        try {
            // Limpiar el HTML
            $cleanHtml = strip_tags($content, '<p><b><strong><i><em><u><ul><ol><li><br><a><img><h1><h2><h3><h4><h5><h6>');
            
            // Validar y cargar en DOMDocument
            $dom = new \DOMDocument();
            $dom->loadHTML($cleanHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            
            // Manejar el DOMDocument según sea necesario
            return $dom->saveHTML();
            
        } catch (\Exception $e) {
            // Manejar errores si ocurren
            return $content; // Devolver el HTML original si no se puede limpiar
        }
    }

}
