const electorn = require('electron');

const {app, BrowserWindow} = electorn;

app.on('ready', () => {
    var main_window = new BrowserWindow(
        {
            fullscreen: true,
            backgroundColor: '#312450'
        });
    // main_window.once('ready-to-show', () => {
    // 	mainWindow.show();
    // })

    main_window.loadURL('http://system.test');
});

app.on('close-me', (evt, arg) => {
    app.quit();
})
