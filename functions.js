window.dismissibleAlert = function(alertType, alertText, alertId, hookerId)
{
    const hooker = document.getElementById(hookerId);   // The hoooker div has been created dynamically by the createContainerAlert function
    return hooker.innerHTML = `
            <div class="row justify-content-center">
                <div class="col col-md-4">
                    <div class="alert alert-${alertType} alert-dismissible fade show mt-2" role="alert">
                        ${alertText}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="${alertId}"></button>
                    </div>
                </div>
            </div>
        `   // Creating the alert by manipulating the DOM and inserting the alert into the container
};

window.createContainerAlert = function(inputFieldName, alertMessage)
{
    let fieldName = document.getElementById(inputFieldName)  // Get the form element and assign it to a variable
    let fieldNameLength = fieldName.value.length;   // Assigning the length of the input to a variable 
    let fieldNameContainer; // Creating the container

    if(fieldNameLength == 0)    // Checking if the input box is empty
    {
        fieldNameContainer = document.createElement("div"); // Creating the container
        fieldNameContainer.id =  `fill${inputFieldName.charAt(0).toUpperCase() + inputFieldName.slice(1)}Container`; // assigning the appropriate ID with camelcase
        fieldNameContainer.classList.add("container"); // adding the bootstrap class

        document.body.insertBefore(fieldNameContainer, document.body.form); // adding the container before the form
        dismissibleAlert('warning', alertMessage, `fill${fieldName}`, fieldNameContainer.id); // creating the alert 

        setTimeout(function() { 
            fieldNameContainer.remove();
        }, 5000);

        return true;
    }

    return false;
}


const phonebookURL = 'http://10.0.3.13/phonebook_app'; // Shortcut in order to not insert 'everywhere' the full url

