document.addEventListener('DOMContentLoaded', function() {
    //SEPARATE LAB DISPLAY BOX// 
    //The overarching container
    var labDisplay = document.createElement('div');
    labDisplay.className = 'lab-display';
  
    //Contains info for and displays name of the lab
    var labName = document.createElement('div');
    labName.className = 'lab-name';
    labName.innerHTML = "CHEM 1211K SECTION 64" //<----REPLACE WITH PHP/OTHER SOLUTION
    labDisplay.appendChild(labName);
  
    //Contains info for and displays the rating of the lab
    var labRating = document.createElement('div');
    labRating.className = 'lab-rating';
    labRating.innerHTML = "2.8" //<----REPLACE WITH PHP/OTHER SOLUTION
    labDisplay.appendChild(labRating);
  
    //SEPARATE LAB DISPLAY BOX// 
    //The overarching container
    var labDisplay2 = document.createElement('div');
    labDisplay2.className = 'lab-display';
  
    //Contains info for and displays name of the lab
    var labName = document.createElement('div');
    labName.className = 'lab-name';
    labName.innerHTML = "BIO 1212K SECTION 31" //<----REPLACE WITH PHP/OTHER SOLUTION
    labDisplay2.appendChild(labName);
  
    //Contains info for and displays the rating of the lab
    var labRating = document.createElement('div');
    labRating.className = 'lab-rating';
    labRating.innerHTML = "4.5" //<----REPLACE WITH PHP/OTHER SOLUTION
    labDisplay2.appendChild(labRating);
  
    //APPENDING LAB DISPLAYS TO OVERARCHING CONTAINER
    var labDisplayContainer = document.getElementsByClassName("lab-display-container")[0];
    labDisplayContainer.appendChild(labDisplay);
    labDisplayContainer.appendChild(labDisplay2);
}, false);