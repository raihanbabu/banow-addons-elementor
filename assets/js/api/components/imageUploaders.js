function initImageUploaders() {
    const imageUploaders = Array.from(document.querySelectorAll('input.image-uploader'));

    imageUploaders.forEach(imageUploader => {
        if (imageUploader.init) return;
        
        imageUploader.setAttribute('accept', 'image/png, image/jpeg'); // TODO - Also gif?

        const id = imageUploader.id || getGuid();
        imageUploader.id = id;

        const container = elm('div', 'image-uploader__container');
        const label = elm('label', 'image-uploader__label card');
        label.setAttribute('for', id);
        label.innerHTML = '<i class="fa fa-images"></i><div>Upload Images</div>';

        imageUploader.parentNode.insertBefore(container, imageUploader);
        container.appendChild(imageUploader);
        container.appendChild(label);

        imageUploader.addImage = src => {
            const imageContainer = elm('div', 'image-uploader__image-container js-image-uploader-image');
            const image = elm('img', 'image-uploader__image');
            const imageProgress = elm('div', 'image-uploader__image-progress');
            const imageRemove = elm('div', 'image-uploader__remove');

            imageContainer.appendChild(image);
            imageContainer.appendChild(imageProgress);
            imageContainer.appendChild(imageRemove);
            imageProgress.innerText = '0%';
            imageRemove.appendChild(elm('i', 'fa fa-times'));

            container.insertBefore(imageContainer, label);
            image.setAttribute('src', src);

            imageRemove.addEventListener('click', e => {
                imageContainer.remove();
                showToast('Image removed.');
                imageUploader.checkMax();
            });
            
            imageUploader.checkMax();
            

            return imageContainer;
        }

        imageUploader.getValues = () => {
            const values = [];
            const images = Array.from(container.querySelectorAll('[data-value]'));
            images.forEach(image => {
                values.push(image.dataset.value);
            });

            return values;
        };

        imageUploader.setValues = values => {
            imageUploader.value = '';
            Array.from(container.querySelectorAll('.image-uploader__image-container')).forEach(img => {
                img.remove();
            });
            
            values.forEach(src => {
                const imageContainer = imageUploader.addImage(src)
                imageContainer.querySelector('.image-uploader__image-progress').remove();
            });
        };

        imageUploader.reset = () => imageUploader.setValues([]);

        imageUploader.addEventListener('change', changeEvent => {
            if (imageUploader.files && imageUploader.files[0]) {
                for (const file of imageUploader.files) {
                    const reader = new FileReader();
                    reader.onload = loadEvent => {
                        const imageContainer = imageUploader.addImage(loadEvent.target.result);
                        const imageProgress = imageContainer.querySelector('.image-uploader__image-progress');

                        api_call("/users/uploadphoto.post.json", {
                            photo: file
                        }, function(statusCode, statusMessage, data){
                            imageProgress.remove();
                            imageContainer.dataset.value = data.url;
                        }.bind(this), NO_CACHED, function(p){
                            imageProgress.innerText = p + "%";
                        }.bind(this));
                    }
                    reader.readAsDataURL(file);
                }
            }
        });

        imageUploader.checkMax = () => {
            const maxImages = parseInt(imageUploader.getAttribute('max-uploads'));
            if (!isNaN(maxImages)) {
                const count = Array.from(container.querySelectorAll('.js-image-uploader-image')).length;
                if (count >= maxImages) {
                    hide(label);
                } else {
                    unhide(label);
                }
            }
        }

        imageUploader.init = true;
    });
}

if (typeof Router !== 'undefined') Router.registerDomChangeCallback('initImageUploaders', initImageUploaders);

initImageUploaders();




function uploadImages(input){
    if (input.files && input.files[0]) {
        for(const file of input.files){
            this.uploadcount++;
            var reader = new FileReader();
            reader.onload = function (e) {
                
                const imageIndex = document.querySelectorAll('.eupload-item').length;
                var imageEl = this.itemClone.cloneNode(true);
                imageEl.querySelector('.eupload-progress').innerText = "0%";
                imageEl.querySelector('img').setAttribute('src', e.target.result);
                imageEl.setAttribute('data-index', imageIndex);
                imageEl.querySelector('.eupload-item-remove').setAttribute('data-index', imageIndex);
                this.toolContainer.querySelector('.eupload-list').appendChild(imageEl);
                imageEl.querySelector('.eupload-item-remove').addEventListener('click', this.removeImage.bind(this));
                this.images.push(e.target.result);
                this.showHideContainers();
                api_call("/users/uploadphoto.post.json", {
                    photo: file
                }, function(statusCode, statusMessage, data){
                    this.uploadcount--;
                    imageEl.querySelector('.eupload-progress').style.display = 'none';
                    imageEl.setAttribute('data-url', data.url);
                }.bind(this), NO_CACHED, function(p){
                    imageEl.querySelector('.eupload-progress').innerText = p + "%";
                }.bind(this));
            }.bind(this);
            reader.readAsDataURL(file);
        }
    }
}