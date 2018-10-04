                                               Preventing CSRF
Implementing a web application that matches following criteria to prevent CSRF via Synchronizer (CSRF) Tokens and Double Submit Cookie
.
● User login. I use hard coded user credentials for demonstration purpose.(Username = sanda and password = 123)
● Upon login, generate session identifier and set as a cookie in the browser.
● At the same time, generate the CSRF token and store it in the server side. I store it in-memory using TextFile. The CSRF token is mapped to the session identifier.
● In the website, implement an endpoint that accepts HTTP POST requests and respond with the CSRF token. The endpoint receives the session cookie and based on the session identifier, return the CSRF token value.
● Implement a webpage that has a HTML form. The method should be POST and action should be another URL in the website. When this page loads, execute an Ajax call via a javascript, which invokes the endpoint for obtaining the CSRF token created for the session.
● Once the page is loaded, modify the HTML form’s document object model (DOM) and add a new hidden field that has the value of the received CSRF token.
● Once the HTML form is submitted to the action, in the server side, extract the received CSRF token value and check if it is the correct token issued for the particular session. For this, need to obtain the session cookie and get the corresponding CSRF token for the session and compare that with the received token value.
● If the received CSRF token is valid, show success message. If not show error message with the cookie.

Use my blogpost to get an understanding about this method!

https://sanda94.blogspot.com/2018/09/cross-site-request-forgerycsrf.html
