##Developers
Connor Abdelnoor & Brett Moore

##Date
March 18 2015

##Description
Restaurant app will let you enter and edit different cuisine choices, and then enter and edit different
restaurants under those cuisine types.


##Use and Editing
To use the app, download the source code and run it in on your php server.
You will need to create a psql database with the following tables and attributes:<br />
restaurant- id serial PRIMARY KEY, name varchar, cuisine_id int, review varchar, rating int.<br />
cuisine - id serial PRIMARY KEY, type varchar.

To edit the app, download the source code and open it in your text editor. <br />
    *Note: If you are copying any of the code to your own directories, you may need to install Composer
    in your root directory.*

##Copyright (c) 2015 Connor Abdelnoor & Brett Moore
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
