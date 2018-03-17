// Table to paginate
// const container = document.querySelector('#containerTable');
const tables = document.querySelectorAll('.archive-table');
/* const tbody = document.querySelector('.paginationTbody');
let tableRows = document.querySelectorAll('.paginationTbody tr');*/

// Number of item per page
let itemsPerPage = 5;


// Save rows
let save = new Array([]);
for(let i = 0; i < tables.length; i++){
    paginateTable(i)
        .then(() => {
            tables[i].previousElementSibling.className += ' none';
            tables[i].style.display = "block";
        })
        .catch(err => console.log(err.message));
}

async function paginateTable(index) {
    let container = tables[index].parentNode;
    let tablebody = tables[index].querySelector('.archive-table tbody');
    let tbody = tablebody.id;
    let tableRows = tables[index].querySelectorAll('.archive-table tr');
    let totalRow = tableRows.length

    // Number of page
    let numberPages = Math.ceil(totalRow / itemsPerPage);

    if(numberPages > 1) {
        for(let j = 0; j < totalRow; j++){
            if (!save[index])
                save[index] = []
            save[index][j] = tableRows[j].outerHTML;
        }

        let button = document.createElement("DIV");
        button.id = `buttons-${index}`;
        container.appendChild(button);
        
        sort(1, index, tbody, numberPages, totalRow);
    }
}

function sort(currentPage, currentTable, tbody, numberPages, totalRow) {
    let tablebody = document.getElementById(tbody);
    curr = currentPage - 1;
    let output = '';

    for(let i = curr * itemsPerPage; i < (curr + 1) * itemsPerPage && i < totalRow; i++){
        output += save[currentTable][i];
    }
    tablebody.innerHTML = output;

    document.getElementById("buttons-"+currentTable).innerHTML = pageButtons(currentPage, currentTable, tbody, numberPages, totalRow);
    document.getElementById(`btn-${currentTable}-${currentPage}`).className += 'active';
}

function pageButtons(currentPage, currentTable, tbody, numberPages, totalRow){
    let previousDisplay = currentPage === 1 ? 'disabled' : '',
        nextDisplay = currentPage === numberPages ? 'disabled' : '';
    let buttons = '';

    buttons += `<ul class="pagination"><li><span onclick="sort(${currentPage - 1}, ${currentTable}, '${tbody}', ${numberPages}, ${totalRow})" ${"class=\""+previousDisplay+"\""}>&lt;&lt; Prev</span></li>`;
    for(let i = 0; i < numberPages; i++) {
        buttons += `<li><span id="btn-${currentTable}-${i+1}" onclick="sort(${i+1}, ${currentTable}, '${tbody}', ${numberPages}, ${totalRow})">${i+1}</span></li>`;
    }
    buttons += `<li><span onclick="sort(${currentPage + 1}, ${currentTable}, '${tbody}', ${numberPages}, ${totalRow})" ${"class=\""+nextDisplay+"\""}>&gt;&gt; Next</span></li></ul>`;

    return buttons;
}