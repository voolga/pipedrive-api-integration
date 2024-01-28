   ***Main task - implement a creation of new Deal and Client entity with custom fields using a form, placed on a third-party hosting service (also need to implement). Additional tasks - link new Deal with newly created Client; dinamical creation of form options for some fields that are connected with CRM custom fields (double-sided binding)***

**1**
Set up a website on free hosting service
Iimplemented SSL certification

![image](https://github.com/voolga/pipedrive-api-integration/assets/88053873/780eefa2-1082-4ec9-b76f-e2943ff9841a)
![image](https://github.com/voolga/pipedrive-api-integration/assets/88053873/3e2a9004-1554-4be6-9522-ddeeb519188b)


**2**
At CRM interface created custom fields with various data types 

![image](https://github.com/voolga/pipedrive-api-integration/assets/88053873/b39cde93-aea4-445a-8e31-66bdb0820067)


**3 - index.php**
implemented a client-side template fields for creating a new Deal entity, including
 - simple inputs (text, email, number types) - HTML code 
 - complex fields - selects with options - for them data was pulled via GET request to CRM API.
   *I used a loop to iterate through response and add the necessary variables with HTML markup. Then, I pushed them into the layout.*
   **Regarding this they will be dinamically update in the template in the case of edits in the admin panel**

![image](https://github.com/voolga/pipedrive-api-integration/assets/88053873/adf0052d-f2b0-420c-b8ad-a51fb6bbd34d)
![image](https://github.com/voolga/pipedrive-api-integration/assets/88053873/38f719fc-4c30-485d-81fe-6f9a29015f64)


**4 - app.js**
Implemented data submission on the client-side without reloading the page. 
Added a basic loading indicator as a spinner and primitive error handling for the submission

![image](https://github.com/voolga/pipedrive-api-integration/assets/88053873/0a5e08fd-e34e-49e8-b914-4ddd11d810f0)
![image](https://github.com/voolga/pipedrive-api-integration/assets/88053873/0d1f33b3-7998-445f-a151-97ca04ebbda0)

**5**
After submitting the form, a new order with all fields is created in my CRM panel. 

![image](https://github.com/voolga/pipedrive-api-integration/assets/88053873/afbef833-8754-4144-bf9c-543b72275beb)

**6 - rest.php**
I process the request in PHP, as it was faster to find free hosting. The processing involves handling the request fields

