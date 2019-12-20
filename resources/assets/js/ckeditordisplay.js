$(function () {
    CKEDITOR.replace('editor', {
        language: 'fr',
        customConfig: "{{ asset('bower_components/AdminLTE/plugins/ckeditor/config.js') }}"
    });
});