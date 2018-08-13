import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Index extends Component {
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Example Component</div>

                            <div className="card-body">
                                I'm an example component!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

// remember: for runing semi real time changes run npm run watch
// hand to hand with php artisan serve while serving
if (document.getElementById('root')) {
    ReactDOM.render(<Index />, document.getElementById('root'));
}
