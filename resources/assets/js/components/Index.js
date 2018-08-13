import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import App from './App' 


// remember: for runing semi real time changes run npm run watch
// hand to hand with php artisan serve while serving
if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}
