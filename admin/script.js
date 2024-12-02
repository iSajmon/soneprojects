function qs(a){return document.querySelector(a);}
function qsa(a) {return document.querySelectorAll(a);}

const list = qs('#list');

function addUl(thisButton) {

    thisButton.style.display = 'none';
    const newLi = document.createElement('li');
    newLi.innerHTML = `
        <li>
            <div class="listItems">
                <textarea type="text" name="update[]" required></textarea>
                <button class='addRow' type="button" onclick="addUl(this)" >+</button>
            </div>
        </li>
    `;
    
    list.appendChild(newLi);

}

function resetList() {

    list.innerHTML = `
     <li>
            <div class="listItems">
                <textarea type="text" name="update[]" required></textarea>
                <button class='addRow' type="button" onclick="addUl(this)" >+</button>
            </div>
        </li>
    `;
}

function show(button, parentName) {
    console.log(parentName)
    const parent = button.closest('.'+parentName);



   if(!parent.classList.contains(parentName+'Visible')){
        parent.classList.add(parentName+'Visible');
        button.style.rotate = '-90deg';
   } else {
    parent.classList.remove(parentName+'Visible');
    button.style.rotate = '90deg';
   }

}

function imgType(value) {
    const img = qs('#img') 
    img.value = value;
}

function editProject(button) {

    const project = JSON.parse(button.getAttribute('data-project'));


    console.log(project); 

    qs('input[name="id"]').value = project.id;
    qs('input[name="name"]').value = project.nazwa;
    qs('input[name="url"]').value = project.url;
    qs('input[name="img"]').value = project.photo;
    qs('textarea[name="badge"]').value = project.badge || '';
    qs('textarea[name="description"]').value = project.description;
    qs('input[name="showcase"]').checked = project.showcase === 'yes'; 


    const buttons = qs('.buttons');
    buttons.innerHTML = `
        <button type="submit" id="submitButton">ZAPISZ</button>
        <button type="reset" onclick="resetForm()">ANULUJ</button>
    `;


    qs('#projectForm').action = 'php/modifyProject.php';
}

function resetForm() {
    qs('#projectForm').reset();


    const buttons = qs('.buttons');
    buttons.innerHTML = `
        <button type="submit" id="submitButton">DODAJ</button>
        <button type="reset" onclick="resetList()">RESET</button>
    `;

    qs('#projectForm').action = 'php/addProject.php';
}
