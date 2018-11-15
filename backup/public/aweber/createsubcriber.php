<?php
require('aweber_api/aweber_api.php');

class MyApp{

    function __construct() {
        # replace XXX with your real keys and secrets
        $consumerKey    = "Aki0hrNmNnnJ64EDYY4NAhP8";
        $consumerSecret = "s47aKNtkMWDbp7yAxqqWfO4y882VAHt6EHo83FJP";
        $accessToken = 'XXX';
        $accessSecret = 'XXX';
        $aweber = new AWeberAPI($consumerKey, $consumerSecret);


//            $account = $aweber->getAccount($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);

        if (empty($_COOKIE['accessToken'])) {
            if (empty($_GET['oauth_token'])) {
                $callbackUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                list($requestToken, $requestTokenSecret) = $aweber->getRequestToken($callbackUrl);
                setcookie('requestTokenSecret', $requestTokenSecret);
                setcookie('callbackUrl', $callbackUrl);
                header("Location: {$aweber->getAuthorizeUrl()}");
                exit();
            }

            $aweber->user->tokenSecret = $_COOKIE['requestTokenSecret'];
            $aweber->user->requestToken = $_GET['oauth_token'];
            $aweber->user->verifier = $_GET['oauth_verifier'];
            list($accessToken, $accessTokenSecret) = $aweber->getAccessToken();
            setcookie('accessToken', $accessToken);
            setcookie('accessTokenSecret', $accessTokenSecret);
            header('Location: '.$_COOKIE['callbackUrl']);
            exit();
        }

        # set this to true to view the actual api request and response
        $aweber->adapter->debug = false;

        $account = $aweber->getAccount($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);
        $this->account = $aweber->getAccount($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);
        // $this->list = $this->findList(' list 2');
        $this->list = $this->findList('firstlist');
    }

    function display() {
        if(isset($_POST['submit'])) {

                $subscriber = array(
                    'email' => $_POST['email'],
                    'name'  => $_POST['name']
                );

                echo "Thank you {$_POST['name']}!<br /><br />";
                $this->addSubscriber($subscriber, $this->list);
                //pass a list object [assoc. array] and subscriber object [assoc. array]
        }

        else {
            $this->connectToAWeberAccount();
        }
    }

    function connectToAWeberAccount() {
        $appID = '7XXXXXX8';
        $appID = 'eadf56e5';
        //appID is used to authenticate. To get account data via the api, you
        //must use the consumer key and secret along with the access key and secret
        //associated with the AWeber Account being queried.
        $authorize_url = "https://auth.aweber.com/1.0/oauth/authorize_app/$appID";
        $callback_url = 'http://localhost:8888/aweber-AWeber-API-PHP-Library/mysite.php';
        $callback_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if(empty($_GET['authorization_code'])) {
            echo <<<HTML
            Connect to my app with your AWeber Account<br />
            <input type="button" value="Connect" onclick="location.href='$authorize_url?oauth_callback=$callback_url'"/><br />
HTML;
        }

        if(isset($_GET['authorization_code'])) {
            $credentials = AWeberAPI::getDataFromAweberID($_GET['authorization_code']);
            list($consumerKey, $consumerSecret, $accessKey, $accessSecret) = $credentials;
            $this->showForm();
            return $credentials;
        }
    }

    function showForm() {
        echo <<<HTML
        <form action="" method="post">
        Sign Up for my Newsletter!<br /><br />
        Name:  <input type="text" name="name"/><br />
        Email: <input type="text" name="email"/><br />
        <br />
        <input type="submit" value="submit" name="submit"/>
        </form>
HTML;
    }

    function findList($listName) {
        try {
            $foundLists = $this->account->lists->find(array('name' => $listName));
            //must pass an associative array to the find method

            return $foundLists[0];
        }

        catch(Exception $exc) {
            print $exc;
        }
    }

    function addSubscriber($subscriber, $list) {
        try {
            $listUrl = "/accounts/{$this->account->id}/lists/{$list->id}";
            $list = $this->account->loadFromUrl($listUrl);

            $newSubscriber = $list->subscribers->create($subscriber);
            print_r($newSubscriber);
            print "<br /><br />$newSubscriber->email<br /><br />";
            //you need extended permissions to access the subscriber email
        }

        catch(Exception $exc) {
            print $exc;
        }
    }
}


$app = new MyApp();
$app->display();
