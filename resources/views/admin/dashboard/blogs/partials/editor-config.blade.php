<script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
<script>
    // Blog description editor. The site always shows article text in white with its own
    // fonts, so text/background colors, fonts and sizes are not kept (use the headings
    // in the format list for bigger text). Each language editor gets its own direction.
    window.blogEditorConfig = function (locale) {
        return {
            filebrowserUploadUrl: @json(route('admin.ckeditor.upload', ['_token' => csrf_token()])),
            filebrowserUploadMethod: 'form',
            contentsLanguage: locale,
            contentsLangDirection: locale === 'ar' ? 'rtl' : 'ltr',
            removeButtons: 'TextColor,BGColor,Font,FontSize,BidiLtr,BidiRtl',
            disallowedContent: '*[dir]{color,background,background-color,font-family,font-size}; font'
        };
    };
</script>
