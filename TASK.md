# URL Shortener - Homework #3
Software Developer Homework from KeyMakr

## 1. URL shortener
Implement URL shortener web-application, using programming languages, and databases your choice.

You are not allowed to use frameworks such as symphony, Django etc.

Index page should display a form offering user to shorten a URL. After form was submitted, short URL should be displayed to the user.

Short URLs should redirect to original URLs. 

Your implementation should be able to sustain 100 URL submissions and 1,000 short URL accesses per minute. 

You may assume that there will be approximately 1,000,000 unique URLs and all further submissions will be duplicates of URLs submitted previously. 

## 2. Scale 
Assuming we want to scale it up to 10,000 URL submissions and 10,000,000 short URL accesses per second with up to 10,000,000,000 unique URLs. 

Please add a note (as a separate document) summarizing what changes need to be done in your code to support such scale and how to set up such a system. 


## 3. Extras (optional) 
Include docker file in your solution. You can help us to better understand how you approach complex tasks by sending us a git repository containing all intermediate commits you made while working on this task. 