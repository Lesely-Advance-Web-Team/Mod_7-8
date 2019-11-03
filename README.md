# Module 7 &amp; 8 Project
## Custom CMS Group Project

> ### **Assignment Deliverables**
> <p>Github project completed based on requirements</p>
> <p>Explain Your Work deliverable</p>
> <p>In addition to completing the above, for this activity you will need to submit an "Explain Your Work" deliverable, which can be a paper with screenshots or a screenshared video showing your work. This will help you practice explaining tech concepts as well as help the instructor grade your understanding of key concepts.</p>

---

### **Build any Web Application that you want:**

Be creative, but also remember that you only have a week to complete the assignment. A CMS does not have to be a blog, you could build a Recipe book CMS, or a Photo Album etc. Using PHP templating, you can take any input and generate content!
- **What kind of CMS are you creating?**
  - We are creating a Photobook CMS where people can upload fashion to this site.

---

### **Use Server-side code:**
- **Use MAMP to run the servers for this project**
  - We used MAMP to run the servers for this project. MAMP was already downloaded and configured to my computer. I then created a a repo in GitHub and linked it to my Visual Studio. I added my code for this application in a index.php file.
- **Use PHP include to practice DRY programmin and build content templates**
  - I took the header, navigation, and footer pieces into another folder and customized. In the index file I used PHP include to practice DRY programing method.
    - Server-side code is running on Apache server via WAMP and has PHP DRY code. The format of our code includes several practices of the DRY method. For example, It starts off with html at the top and includes the php files to support the site below. I used it for our header, nav, and footer. I used function getPostTitlesFromDatabase() to pull data from the database.
  - Some files and functions that are included are the following:
    - Local – to store images from local.
    - Web - to store images that were uploaded to the database.
    - Index – The skeleton of the home website.
    - Header – To store the header details and format.
      - `<?php include 'header.php' ?>` was inserted into the index.php file.
    - Footer – To store the footer details and format.
      - `<?php include 'footer.php' ?>` was inserted into the index.php file.
    - Nav – To store the menu titles, links, and format.
      - `<?php include 'nav.php' ?>` was inserted into the index.php file.
    - JS – To hold the javascript code.
    - Styles.css - The stores the CSS code for the style of the site.
    - Upload – The area in where visitors’ cans submit single or multiple images to the blog. This information will get sent to the server and stored in the database for it to be displayed in the sites home page.

--- 

**Use a Database:**
- **Use phpMyAdmin to administer and create a new MySQL database**
  - Used SQLQuery CRUDE: `CREATE DATABASE modphoto_fashion`
  - Then created Our table "fashion" which has the following fields: ID, name, img_dir. ID was set to AI & Primary.

  - | # | Name         |     Type     |
    | - |:------------:| ------------:|
    | 1 | ID           |   int(11)    |
    | 2 | name         | varchar(255) |
    | 3 | img_dir      | varchar(255) | 
    
- **Write PHP code that reads data from the database**
  - In the index.php file I added the following code to read from the database:
```  
        <?php
 $mysqli = new mysqli('138.201.81.134','modphoto_vbowie','Secur3Passw0rd!','modphoto_fashion') or die($mysqli->connect_error);
        $table = 'fashion';
        
        $result = $mysqli->query("SELECT * FROM $table") or die($mysqli->error);
        
        while ($data = $result->fetch_assoc()){
            echo "<h2>{$data['name']}</h2>";
            echo "<img src='{$data['img_dir']}' width='40%' height='40%'>";
        }
        
        ?>
```
- **Write PHP code that adds data to the database**
  - In the upload.php file I added the following code to add images to the database:
```  
<?php
$mysqli = new mysqli('138.201.81.134','modphoto_vbowie','Secur3Passw0rd!','modphoto_fashion') or die($mysqli->connect_error);
$table = 'fashion';

$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
);

//$_$FILES global variable
if(isset($_FILES['userfile'])){
    
    $file_array = reArrayFiles($_FILES['userfile']);
    //pre_r($file_array);
    for ($i=0;$i<count($file_array);$i++){
        if ($file_array[$i]['error']) 
        {
            ?> <div class="alert alert-danger"> 
            <?php echo $file_array[$i]['name'].' - '.$phpFileUploadErrors[$file_array[$i]['error']]; 
            ?> </div> <?php
        }
        else {
            
            $extensions = array('jpg','png','gif','jpeg');
            
            $file_ext = explode('.',$file_array[$i]['name']);
            
            $name = $file_ext[0];
            $name = preg_replace("!-!"," ",$name);
            $name = ucwords($name);
            
            $file_ext = end($file_ext);
            
            if (!in_array($file_ext, $extensions)) 
            {
                ?> <div class="alert alert-danger"> 
                <?php echo "$name - Invalid file extension!"; 
                ?> </div> <?php
            }
            else {
                
                $img_dir = 'web/'.$file_array[$i]['name'];
                
                move_uploaded_file($file_array[$i]['tmp_name'], $img_dir);
                
                $sql = "INSERT IGNORE INTO $table (name,img_dir) VALUES('$name','$img_dir')";
                $mysqli->query($sql) or die($mysqli->error);
                
                ?> <div class="alert alert-success"> 
                <?php echo $name.' - '.$phpFileUploadErrors[$file_array[$i]['error']]; 
                ?> </div> <?php
            }
        }
    }
}

function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
```

---
**Use Client-side code:**
- **Use JS to access content from the DOM**
  - Our client-side code includes JS which accesses content from the DOM. Our code includes the code: document.getElementsByTagName('body') which returned the body node from the DOM. We also used getElementById to get elements with the matching ID and to get elements with matching class we used getElementsByClassName. We also used it for customizing the header.
- **What kind of POST requests did you have in your CMS?**
  - The types of POST requests that is inserted into our Photobook CMS would allow users to share cool fashion. They would share post as an image that has a title.
  
---
**Use Github workflow & Host Site:**
- Create a Github organization for your team ( We did this by doing the following below)
  - Create a team repo owned by the organization
    - https://github.com/Lesely-Advance-Web-Team/Mod_7-8
  - We used GIT fork, pull requests, merge workflow
  - We wrote our response in Markdown format
- Host Your Site:
  - I bought the domain name from http://www.Namecheap.com and then used http://www.FreeHosting.com to host the site:
  - I uploaded my files to the public html file. 
    - We had to update the details in the index.php and upload.php files to ensure that it would be communicating with the database via http://www.FreeHosting.com
  - Check out our website: https://www.mod7photobook.club

  

