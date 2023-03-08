const ResponseHelper = {
    handle: function (xhr) {
        if (xhr.responseJSON && xhr.responseJSON.errors) {
            Object.keys(xhr.responseJSON.errors).forEach(function (key) {
                xhr.responseJSON.errors[key].forEach(function (message) {
                    iziToast.error({
                        title: 'Error!',
                        message: message,
                        position: 'topRight'
                    });
                });
            });
        }
    }
}