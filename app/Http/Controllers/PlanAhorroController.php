<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanAhorro;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PlanAhorroController extends Controller
{

    public function index()
    {
        return view('admin.plan_ahorro.index')->with(['planes' => PlanAhorro::orderBy('created_at', 'desc')->get()]);
    }
    public function peugeot()
    {
        $dominio = "https://www.peugeotplan.com.ar/";
        $ruta = "pageValue/getAllFor/peugeot/car_models/0";
        $url = $dominio . $ruta;

        // Inicia una transacción
        DB::beginTransaction();

        try {
            PlanAhorro::where('pdaMarca', 'peugeot')->delete();
            $response = Http::get($url);

            if ($response->failed()) {
                throw new \Exception("Error al obtener el contenido de la URL");
            }

            $data = $response->json();
            foreach ($data['items']['carModels'] as $carModel) {
                if ($carModel['enabled']) {
                    $planAhorro = [
                        'pdaMarca' => 'peugeot',
                        'pdaDescrip' => $carModel['detailsName'],
                        'pdaCuotaBase' => $this->textToImporte($carModel['feeStartingAt']),
                        'pdaModelo' => strtolower(explode(" ", $carModel['buttonName'])[0]),
                        //'pdaModCodigo' => $this->getModeloId(strtolower(explode(" ", $carModel['modelName'])[0])),
                        //'pdaModelo' => explode(" ", $carModel['modelName'])[0],
                        'pdaVersion' => explode(" ", $carModel['modelName'])[1] ?? '',
                    ];

                    $detallesUrl = $dominio . "pageValue/getCarModelWithoutFiles/" . $carModel['id'];
                    $responseDetalles = Http::get($detallesUrl);

                    if ($responseDetalles->successful()) {
                        $detalleData = $responseDetalles->json();
                        foreach ($detalleData['savingPlans'] as $savingPlan) {
                            if ($savingPlan['buttonEnabled']) {
                                $planAhorro['pdaNombre'] = explode(" ", $savingPlan['planDetails']['name'])[0];
                                $planAhorro['pdaTipoPlan'] = "80/20";

                                $planAhorro['pdaLegales'] = $savingPlan['planDetails']['feesTableValuesJson']['legales'] ?? '';
                                $planAhorro['pdaVigencia'] = $savingPlan['planDetails']['feesTableValuesJson']['vigencia'] ?? '';
                                $planAhorro['pdaUrl'] = Str::slug($planAhorro['pdaNombre'] . '-' . $planAhorro['pdaTipoPlan'], '-');

                                PlanAhorro::create($planAhorro);
                            }
                        }
                    }
                }
            }
            DB::commit();
            return response()->json(['status' => 'Planes de ahorro cargados con éxito'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function citroen()
    {
        $dominio = "https://www.citroenplan.com.ar/";
        $ruta = "pageValue/getAllFor/citroen/car_models/0";
        $url = $dominio . $ruta;

        // Inicia una transacción
        DB::beginTransaction();

        try {
            PlanAhorro::where('pdaMarca', 'citroen')->delete();
            $response = Http::get($url);

            if ($response->failed()) {
                throw new \Exception("Error al obtener el contenido de la URL");
            }

            $data = $response->json();
            foreach ($data['items']['carModels'] as $carModel) {
                if ($carModel['enabled']) {
                    $planAhorro = [
                        'pdaMarca' => 'citroen',
                        'pdaDescrip' => $carModel['detailsName'],
                        'pdaCuotaBase' => $this->textToImporte($carModel['feeStartingAt']),
                        'pdaModelo' => strtolower(explode(" ", $carModel['modelName'])[0]),
                        //'pdaModCodigo' => $this->getModeloId(strtolower(explode(" ", $carModel['modelName'])[0])),
                        //'pdaModelo' => explode(" ", $carModel['modelName'])[0],
                        'pdaVersion' => explode(" ", $carModel['modelName'])[1] ?? '',
                    ];

                    $detallesUrl = $dominio . "pageValue/getCarModelWithoutFiles/" . $carModel['id'];
                    $responseDetalles = Http::get($detallesUrl);

                    if ($responseDetalles->successful()) {
                        $detalleData = $responseDetalles->json();
                        foreach ($detalleData['savingPlans'] as $savingPlan) {
                            if ($savingPlan['buttonEnabled']) {
                                $planAhorro['pdaNombre'] = explode(" ", $savingPlan['planDetails']['name'])[0];
                                $planAhorro['pdaTipoPlan'] = "80/20";

                                $planAhorro['pdaLegales'] = $savingPlan['planDetails']['feesTableValuesJson']['legales'] ?? '';
                                $planAhorro['pdaVigencia'] = $savingPlan['planDetails']['feesTableValuesJson']['vigencia'] ?? '';
                                $planAhorro['pdaUrl'] = Str::slug($planAhorro['pdaNombre'] . '-' . $planAhorro['pdaTipoPlan'], '-');

                                PlanAhorro::create($planAhorro);
                            }
                        }
                    }
                }
            }
            DB::commit();
            return response()->json(['status' => 'Planes de ahorro cargados con éxito'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

	private function textToImporte($s)
	{
		//echo "textToImporte({$s})<br/>";
		return preg_replace('/\D/', '', $s);
	}
}
