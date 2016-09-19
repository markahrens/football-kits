import React from 'react'
import { render } from 'react-dom'
import App from './modules/App'
render(<App/>, document.getElementById('app'))

import { Router, Route, browserHistory, IndexRoute } from 'react-router'

import About from './modules/About'
import Clubs from './modules/Clubs'
import Club from './modules/Club'
import Home from './modules/Home'

render((
  <Router history={browserHistory}>
    <Route path="/" component={App}>
      <IndexRoute component={Home}/>

      <Route path="/clubs" component={Clubs}>
        <Route path="/clubs/:countryCode/:clubSlug" component={Club}/>
      </Route>
      <Route path="/about" component={About}/>
    </Route>
  </Router>
), document.getElementById('app'))
