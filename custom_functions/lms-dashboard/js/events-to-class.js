document.addEventListener("DOMContentLoaded", function() {

    var checkbutton = setInterval(function() {
        // Select the button with the specified class and its span containing "New Event"
        var newEventButton = document.querySelector("button.el-button.am-add-new-button.am-m-0.am-w-100.el-button--primary span span");

        // Check if the button span exists and update its text content
        if (newEventButton) {
            newEventButton.textContent = "New Class";     
        }
       
        // If the button is found, set its onclick attribute to call startChecking function when clicked
        if (newEventButton) {
            document.querySelector("button.am-add-new-button").setAttribute("onclick", "startChecking()");
            clearInterval(checkbutton); // Clear the interval
        }
        
    }, 1000); // Check every 1000 milliseconds (1 second)

});

 // Define the startChecking function in the global scope
 function startChecking() {
    var checkButtonExist = setInterval(function() {
    
        // Select the div with the class "el-dialog__header" and its span containing "New Event"
        var dialogHeaderTitle = document.querySelector("#am-cabinet > div > div > div > div.el-dialog__header > span");
        // Check if the div span exists and update its text content
        if (dialogHeaderTitle && dialogHeaderTitle.textContent === "New Event") {
            dialogHeaderTitle.textContent = "New Class";
        }

        // Select the input field and change its placeholder to "New Class"
        var inputField = document.querySelector("#pane-details > div.el-form-item.is-required > div > div > input");
        if (inputField) {
            inputField.placeholder = "Enter Class Name";
        }

         // Hide the specified element
         var elementToHide = document.querySelector("#pane-details > div.am-event-dates.am-section-grey > div.am-add-event-date");
         if (elementToHide) {
             elementToHide.style.display = "none";
         }

         var pricing
         /*
         // Rename checkbox1
        var checkbox1 = document.querySelector("#pane-details > div:nth-child(3) > label > span.el-checkbox__label");
         if(checkbox1){
            checkbox1.textContent = "This is recurring class";
         }
        */
         var hideCheckbox1 = document.querySelector("#pane-details > div:nth-child(3)");
         if(hideCheckbox1){
            hideCheckbox1.style.display = "none";
         }

         var checkbox3 = document.querySelector("#pane-details > div:nth-child(5) > label > span.el-checkbox__label");
         if(checkbox3){
            checkbox3.textContent = "Booking closes when class starts";
         }
         
         // Add class 'is-checked' to Organizer Checkbox
        var checkboxElement = document.querySelector("#pane-details > div:nth-child(7) > div.el-row > div:nth-child(2) > label > span");
        if (checkboxElement) {
            checkboxElement.classList.add('is-checked');
        }

        // Hide Organizer Checkbox
        var hideOrganizer = document.querySelector("#pane-details > div:nth-child(7) > div.el-row");
        if(hideOrganizer){
            hideOrganizer.style.display = "none";
         }

         // Hide Pricing Tab > Deposit Payment
         var hidedeposit = document.querySelector("#pane-pricing > div > div:nth-child(2)");
         if(hidedeposit){
            hidedeposit.style.display = "none";
         }

         // Hide Pricing Tab > Custom Pricing
         var hideCustom = document.querySelector("#pane-pricing > div > div.am-setting-box.am-switch-box");
         if(hideCustom){
            hideCustom.style.display = "none";
         }

         // Hide Settings Tab > General 
         var hideGeneralSettings = document.querySelector("#pane-settings > div.am-entity-settings > div:nth-child(1)");
         if(hideGeneralSettings){
            hideGeneralSettings.style.display = "none";
         }

         // Hide Settings Tab > Payments
         var hidePaymentSettings = document.querySelector("#pane-settings > div.am-entity-settings > div.el-collapse.am-entity-settings-payments");
         if(hidePaymentSettings){
            hidePaymentSettings.style.display = "none";
         }

        // Rename Settings Tab > Integrations > Google Meet
        var renameGoogleMeet = document.querySelector('#pane-settings .am-entity-settings div.el-collapse:nth-of-type(3) .el-collapse-item .el-collapse-item__wrap .el-collapse-item__content > div:nth-of-type(1) > div > div');
        if(renameGoogleMeet){
        renameGoogleMeet.textContent = "Virtual Class (Google Meet)";
         }

         // Hide Settings Tab > Integrations > Lesson Space
         var hideLessonSpace = document.querySelector('#pane-settings .am-entity-settings div.el-collapse:nth-of-type(3) .el-collapse-item .el-collapse-item__wrap .el-collapse-item__content > div:nth-of-type(2)');
         if(hideLessonSpace){
            hideLessonSpace.style.display = "none";
         }


         // Rename Tags to Course Name (Tags)
         var renameTags = document.querySelector("#pane-details > div:nth-child(7) > div:nth-child(2) > div > div:nth-child(1) > p");
         if(renameTags){
            renameTags.textContent = "Course Name (Tags)";
         }

        // If all elements have been found and updated, clear the interval
        if (dialogHeaderTitle && inputField) {
            clearInterval(checkButtonExist);
            console.log('cleared interval');
        }
          
    }, 1000); // Check every 1000 milliseconds (1 second)
}

