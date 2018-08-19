import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'

class App extends Component {
    constructor(props) {
        super(props)
        this.state = {
            body: '',
            posts: [],
            loading: false
        }
        // bind
        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleChange = this.handleChange.bind(this)
        this.postData = this.postData.bind(this)
        this.getData = this.getData.bind(this)
        this.renderPosts = this.renderPosts.bind(this)
    }

    handleSubmit(event) {
        event.preventDefault()
        this.postData()
    }

    getData () {
        // for showing a loading text
        // this.setState({
        //     loading: true
        // })
        // getting from PostController, index method
        // from web.php
        axios.get('/posts')
        .then((response) => 
                this.setState({
                    posts: [...response.data.posts].reverse(),
                    // loading: false
                })
            )
    }

    componentWillMount () {
        // preload the posts actual user have before component shows up
        this.getData()
    }

    // real time posts showing
    componentDidMount () {
        // requesting posts to the server each second
        // this.interval = setInterval(() => this.getData(), 10000)

        // laravel echo activated in: resources/assets/js
        Echo.private('new-post').listen('PostCreated', (event) => {
            // console.log('from pusher', event)
            // this.setState({
            //     posts: [...this.state.posts, event.post]
            // })

            // window.Laravel was created in head on app.blade html
            if(window.Laravel.user.following.includes(event.post.user_id)) {
                // then add those posts in the timeline
                this.setState({
                    posts: [...this.state.posts, event.post]
                })
            }
        })
    }

    componentWillUnmount () {
        // when user leaves component, it will be executed
        // clearInterval(this.interval)
    }

    postData(event) {
        // method and what to send
        // object to send must be in json
        axios.post('/posts', {
            body: this.state.body
        })
        .then(response => {
            // console.log('from handle submit', response)

            // this response comes from PostController.php after the req
            // to /posts in web.php
            // console.log(response)
            this.setState({
                posts: [...this.state.posts, response.data],
                // clear the state body
                body: ''
            })
        })
    }

    handleChange(event) {
        this.setState({
            body: event.target.value,
            posts: this.state.posts.reverse()
        }) 
    }

    renderPosts() {
        const posts = this.state.posts.reverse()

        return posts.map(post => (
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
        ))
    }
    render() {
        return (
            <div className="container-fluid">
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
                    { this.state.posts.length > 0 && (
                        <div className="col-md-6">
                            <div className="card">
                                <div className="card-header">Recent Tweets</div>
                                <div className="card-body">
                                    {!this.state.loading ? this.renderPosts() : 'Loading...'}
                                </div>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        );
    }
}

export default App