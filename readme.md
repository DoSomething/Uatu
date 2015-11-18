![uatu](http://www.marvunapp.com/Appendix6/uatu_mainimage.jpg)

## Uatu 
##### Uatu is the natural language processing API that supports DoSomething.org's Pregnancy Text campaign. The API is responsible for recognizing incoming SMS messages and sending the appropiate response back.

### How it works

* A user who has opted-in to the pregnancy text campaign, sends a message to the "baby".
* Mobile Commons receives the message and sends a request to Uatu with the user's message, their phone number, mData ID, and other info. 
* Uatu gets the request and matches the user's message with one of the words, phrases, or regex expressions we have defined on the backend. 
* If Uatu finds a match, it responds with the opt-in path ID of the appropiate response and sends a request to the Mobile Commons API that handles sending the response message to the user.

### Tech Specs

There is only one endpoint

```
POST https://uatu.dosomething.org/usermessage
```
Parameters
* **args** (required) String: The user's message.
* **phone** (required) Number: The user's phone number.
* **mdata_id** (required) Number: The mData from Mobile commons that is sending the request. There are two mDatas for the the Pregnancy Text campaign. One for the Long Term version of the campain, and one for the Short Term version. We need the mData ID to determine if we should send the long term or short term reponse.
* **is_test** (optional) Boolean: If set to true, the API will not make the mobile commons request to send a text message back to the user. We use this to test that the application is up and running but don't want to send text messages evertime we run a test.

Response
```
{
  "success": true,
  "opt_in_path": "195444",
  "phone": "9175171438"
}
```

### Admin Stuff
There is a very lightweight CRUD interface for the application that allows us to manage the messages we recognize and the responses to send back. 

**To use it:** Go to `http://uatu.dosomething.org/messages`, if you are not logged in, you will have to login :smile:

### Create a Message
To create a message, click on the `Create a Message` button and fill out the form.

**Type:** 
* Regex: Select this option if you want to match a common string pattern, for example you could use Regex to match a message containing "hahahahaha" :laughing: 
* Word: Select this option if you want to match a single word, either exactly or you want to match messages that have that word in where in the message. 
* Phase: Select this option if you want to match the occurance of a phrase in a message. For example:  "I love you" :heart_eyes_cat:  

**Message:**
Enter the regex expression, word, or phrase you want to match.

**Short Term Response(s):**
Enter a comma seperated list of opt-in path IDs from mobile commons from the short term mData.

**Long Term Response(s):**
Enter a comma seperated list of opt-in path IDs from mobile commons from the long term mData.

**Needs to be exact:** 
Keep this checked if the word or phrase needs to be matched exactly. All of the curse words for example, need to be matched exactly. Uncheck this box, if there could be spelling errors OR if the word or phrase can appear anywhere in the message to be a match. 

**Message has sentiment:**
Keep this checked if the sentiment of the word, regex or phrase could be negated with the inclusion of a negative word. For example, If we are looking for the word "die" in a message, and a user texts in "don't die" we don't want to send a reponse because the inclusion of "don't" changes the sentiment of the message. 

### Edit messages

To edit messages, click on the little gear icon next to a message and click edit. This will take you to a form that will allow you to make changes to the settings on that message. See the field descriptions above for reference.

### Delete messages

Click on the gear icon and click delete. 

:warning: There is no confirm delete feature at the moment, so be careful with this button :warning: 

## Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
