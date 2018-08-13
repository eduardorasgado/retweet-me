import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class App extends Component {
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-6">
                        <div className="card">
                            <div className="card-header">Tweet something new!</div>

                            <div className="card-body">
                                <form>
                                    <div className="form-group">
                                        <textarea className="form-control" 
                                                rows="5" 
                                                maxlength="140" 
                                                placeholder="Whats up?!"
                                                required />
                                    </div>
                                    <input type="submit" value="Post" className="form-control"/>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-6">
                        <div className="card">
                            <div className="card-header">App Component</div>

                            <div className="card-body">
                                I'm an App component!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default App