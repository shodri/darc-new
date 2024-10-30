function cropImage(file, done, width, height) {
    var myDropZone = this;

    var image = new Image();
    image.src = URL.createObjectURL(file);

    image.onload = function() {
        if (this.width == width && this.height == height) {
            let canvas = document.createElement('canvas');
            canvas.width = this.width;
            canvas.height = this.height;

            let context = canvas.getContext('2d');
            context.drawImage(this, 0, 0);

            canvas.toBlob(function(blob) {
                done(blob);
            });
        } else {
            var editor = document.createElement('div');
            editor.style.position = 'fixed';
            editor.style.left = 0;
            editor.style.right = 0;
            editor.style.top = 0;
            editor.style.bottom = 0;
            editor.style.zIndex = 9999;
            editor.style.backgroundColor = '#000';
            document.body.appendChild(editor);

            var buttonConfirm = document.createElement('button');
            buttonConfirm.style.position = 'absolute';
            buttonConfirm.style.left = '10px';
            buttonConfirm.style.top = '10px';
            buttonConfirm.style.zIndex = 9999;
            buttonConfirm.textContent = 'Confirmar';
            editor.appendChild(buttonConfirm);

            buttonConfirm.addEventListener('click', function() {
                var canvas = cropper.getCroppedCanvas({
                    width: width,
                    height: height,
                    fillColor: '#fff',
                });

                canvas.toBlob(function(blob) {
                    var formData = new FormData();
                    formData.append('image', blob);
                    formData.append('_token', '{{ csrf_token() }}');

                    myDropZone.createThumbnail(
                        blob,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        false,
                        function(dataURL) {
                            myDropZone.emit('thumbnail', file, dataURL);
                            done(blob);
                        }
                    );
                });

                document.body.removeChild(editor);
            });

            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            var cropper = new Cropper(image, {
                aspectRatio: width / height
            });
        }
    };
}
