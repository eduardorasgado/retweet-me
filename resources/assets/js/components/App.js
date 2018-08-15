import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'

class App extends Component {
    constructor(props) {
        super(props)
        this.state = {
            body: '',
        }
        // bind
        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleChange = this.handleChange.bind(this)
        this.postData = this.postData.bind(this)
    }

    handleSubmit(event) {
        event.preventDefault()
        this.postData()
    }

    postData(event) {
        // method and what to send
        // object to send must be in json
        axios.post('/posts', {
            body: this.state.body
        })
        .then(response => console.log(response))
    }

    handleChange(event) {
        this.setState({
            body: event.target.value
        }) 
    }
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-6">
                        <div className="card">
                            <div className="card-header">Tweet something new!</div>

                            <div className="card-body">
                                <form onSubmit={this.handleSubmit}>
                                    <div className="form-group">
                                        <textarea className="form-control" 
                                                rows="5" 
                                                maxLength="140" 
                                                placeholder="Whats up?!"
                                                onChange={this.handleChange}
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