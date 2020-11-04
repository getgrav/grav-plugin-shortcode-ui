window.nextgenEditor.addHook('hookInit', () => {
  window.nextgenEditor.addShortcodePlugin('shortcode-ui', {
    title: 'Shortcode UI',
  });

  window.nextgenEditor.addButtonGroup('shortcode-ui', {
    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M2.5 19h19a2.5 2.5 0 002.5-2.5v-14A2.5 2.5 0 0021.5 0h-19A2.5 2.5 0 000 2.5v14A2.5 2.5 0 002.5 19zM18.25 7.5a.75.75 0 011.28-.53l2 2a.749.749 0 010 1.06l-2 2a.746.746 0 01-.53.22.738.738 0 01-.287-.057.75.75 0 01-.463-.693zM2.47 8.97l2-2a.75.75 0 011.28.53v4a.75.75 0 01-.463.693.738.738 0 01-.287.057.746.746 0 01-.53-.22l-2-2a.749.749 0 010-1.06z"/><circle cx="7.5" cy="22.5" r="1.5"/><circle cx="12" cy="22.5" r="1.5"/><circle cx="16.5" cy="22.5" r="1.5"/></svg>',
    label: 'Shortcode UI',
  });
});
