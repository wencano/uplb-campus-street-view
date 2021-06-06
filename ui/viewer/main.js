var Router = ReactRouter.Router;
var Route = ReactRouter.Route;
var IndexRoute = ReactRouter.IndexRoute;

ReactDOM.render(
	<Router history={browserHistory}>
		<Route path={Config.admin} component={Greeting}>
			<Route path={"*"} component={Greeting} />
		</Route>
	</Router>,
	document.getElementById('app')
);