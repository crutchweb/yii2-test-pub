# Yii2-test:
<h2>RoadMap:</h2>

- [x] Implementation sheme of project
- [x] Installing Yii2-basic and create migrations
- [x] Adding authorization through the auth form and creating REST Api with access-token auth
- [x] Learn and implement the algorithm
- [x] Add Implementation loging
- [x] Create console methods
- [x] Add Unit-tests
- [x] Add project documentation

<h2>Sheme of project:</h2>
The scheme is available here - https://esk.one/p/u8vfLWJFJ
<br>

<h2>How to use:</h2>
- First step: Auth from login page /site/login (admin:admin)
- Second step: Get access-token from homepage
- Third step: Send requests and receive responses
<br>

<h2>Example console:</h2>

Method: Get solution <br>
~~~
php yii get-solution <num> <array> <user_id>
~~~

P.S: user_id - not requared

<h2>Example API:</h2>
<h4>Get solution:</h4>

Method: <br>

~~~
/api/1.0/algorithm/get-solution?access-token=<your access-token>
~~~

Request: <br>

~~~
{
  "number": 5,
  "array": [1, 9, 9, 7, 9, 9, 6, 4, 5, 7, 6, 5, 9, 6, 8, 7, 5, 7, 6, 9, 4]
}
~~~

Resposne: <br>

~~~
{
    "success": 18
}
~~~

<h4>Delete solution:</h4>

Method: <br>

~~~
/api/1.0/algorithm/delete-solution?access-token=<your access-token>
~~~

Request: <br>

~~~
{
  "id": 1
} 
~~~

Resposne: <br>

~~~
{
    "message": true
}
~~~

<h4>Get user log:</h4>

Method: <br>

~~~
/api/1.0/log/get-user-log?access-token=<your access-token>
~~~

Request: <br>

~~~
{
  "id": 1
} 
~~~

Resposne: <br>

~~~
{
    "log": [
        {
            "id": "2",
            "user_id": "1",
            "algorithm_id": "10",
            "method": "algorithm-api/get-solution",
            "request": "a:2:{s:6:\"number\";i:5;s:5:\"array\";a:21:{i:0;i:1;i:1;i:9;i:2;i:9;i:3;i:7;i:4;i:9;i:5;i:9;i:6;i:6;i:7;i:4;i:8;i:5;i:9;i:7;i:10;i:6;i:11;i:5;i:12;i:9;i:13;i:6;i:14;i:8;i:15;i:7;i:16;i:5;i:17;i:7;i:18;i:6;i:19;i:9;i:20;i:4;}}",
            "response": "s:2:\"18\";",
            "timestamp": "2020-03-01 17:25:41"
        },
    ]
}
~~~