$app->register(new Provider\SwiftmailerServiceProvider());

$simpleUser = new SimpleUser\UserServiceProvider();
$app->register($simpleUser);


$app['swiftmailer.options'] = array();
