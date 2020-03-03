<?php

namespace tests\unit\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->username)->equals('admin');

        expect_not(User::findIdentity(999));
    }

    //test_db
    /*
    public function testFindUserByAccessToken()
    {
        expect_that($user = User::findIdentityByAccessToken('<your_auth_key>'));
        expect($user->username)->equals('admin');

        expect_not(User::findIdentityByAccessToken('non-existing'));
    }
    */

    public function testFindUserByUsername()
    {
        expect_that($user = User::findByUsername('admin'));
        expect_not(User::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = User::findByUsername('admin');

        //test_db
        //expect_that($user->validateAuthKey('<your_auth_key>'));
        //expect_not($user->validateAuthKey('<your_auth_key>'));

        expect_that($user->validatePassword('admin'));
        expect_not($user->validatePassword('123'));
    }

    public function testBySaveNewUser()
    {
        $user = new User();
        $user->username = 'assa';
        $user->password = 'buba';

        expect_that($user->save());
    }
}
