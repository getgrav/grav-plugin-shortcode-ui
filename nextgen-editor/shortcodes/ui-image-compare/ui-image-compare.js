window.nextgenEditor.addShortcode('ui-image-compare', {
  type: 'block',
  plugin: 'shortcode-ui',
  title: 'UI Image compare',
  button: {
    group: 'shortcode-ui',
    label: 'UI Image compare',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="9.75" cy="6.247" r="2.25"/><path d="M16.916 8.71A1.027 1.027 0 0016 8.158a1.007 1.007 0 00-.892.586l-1.558 3.434a.249.249 0 01-.422.053l-.82-1.024a1 1 0 00-.813-.376 1.007 1.007 0 00-.787.426L7.59 15.71a.5.5 0 00.41.79h12a.5.5 0 00.425-.237.5.5 0 00.022-.486z"/><path d="M22 0H5.5a2 2 0 00-2 2v16.5a2 2 0 002 2H22a2 2 0 002-2V2a2 2 0 00-2-2zm-.145 18.354a.5.5 0 01-.354.146H6a.5.5 0 01-.5-.5V2.5A.5.5 0 016 2h15.5a.5.5 0 01.5.5V18a.5.5 0 01-.145.351z"/><path d="M19.5 22h-17a.5.5 0 01-.5-.5v-17a1 1 0 00-2 0V22a2 2 0 002 2h17.5a1 1 0 000-2z"/></svg>',
  },
  content() {
    return `<div>{{content_editable}}</div>`;
  },
});
