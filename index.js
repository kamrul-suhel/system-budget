const electorn = require('electron');

const { app, BrowserWindow } = electorn;

app.on('ready', () => {
	var main_window = new BrowserWindow({fullscreen: true});
	main_window.loadURL('http://system.test');
});