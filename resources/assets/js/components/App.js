import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'

class App extends Component {
    constructor(props) {
        super(props)
        this.state = {
            body: '',
            posts: []
        }
        // bind
        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleChange = this.handleChange.bind(this)
        this.postData = this.postData.bind(this)
    }

    handleSubmit(event) {
        event.preventDefault()
        this.postData()
        // clear the state body
        this.setState({
            body: ''
        })
    }

    postData(event) {
        // method and what to send
        // object to send must be in json
        axios.post('/posts', {
            body: this.state.body
        })
        .then(response => {
            // this response comes from PostController.php after the req
            // to /posts in web.php
            console.log(response)
            this.setState({
                posts: [...this.state.posts, response.data]
            })
        })
    }

    handleChange(event) {
        this.setState({
            body: event.target.value
        }) 
    }
    render() {
        const posts = this.state.posts.reverse()
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
                                                value={this.state.body}
                                                required />
                                    </div>
                                    <input type="submit" value="Post" className="form-control"/>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-6">
                        <div className="card">
                            <div className="card-header">Recent Tweets</div>

                            <div className="card-body">
                                {posts.map(post => (
                                    <div key={post.id} className="media">
                                        <div className="media-left">
                                            <img src={post.user.avatar} 
                                                    className="media-object mr-2"/>
                                        </div>
                                        <div className="media-body">
                                            <div className="user">
                                                <a href={ `/users/${post.user.username}` }>
                                                    <b>{post.user.username}</b>
                                                </a>{' '}
                                                - { post.created_at }
                                            </div>
                                            <p>{post.body}</p>
                                        </div>
                                    </div>
                                    ))}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default App