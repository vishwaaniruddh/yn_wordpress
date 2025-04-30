jQuery(document).ready(function($){
    var file_frame;

    $(document).on('click', '.upload-client-diary-images', function(e) {
        e.preventDefault();

        if (file_frame) {
            file_frame.open();
            return;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select Images',
            button: {
                text: 'Add to gallery',
            },
            multiple: true
        });

        file_frame.on('select', function() {
            var attachments = file_frame.state().get('selection').toJSON();
            var imageList = $('#client-diary-images-list');
            imageList.empty();

            attachments.forEach(function(attachment) {
                var imgHTML = '<li><img src="' + attachment.url + '" style="max-width: 150px; max-height: 150px;" /><a href="#" class="remove-image">Remove</a><input type="hidden" name="client_diary_images[]" value="' + attachment.url + '" /></li>';
                imageList.append(imgHTML);
            });
        });

        file_frame.open();
    });

    $(document).on('click', '.remove-image', function(e) {
        e.preventDefault();
        $(this).closest('li').remove();
    });
});
