document.addEventListener('DOMContentLoaded', ready);
function ready() {
  // burger menu
  burgerMenu();
  // room type select
  roomTypeSelect();
}
function burgerMenu() {
  // burger menu 
  let menu = document.getElementById("menu");
  let burgerMenu = document.getElementById("menu-btn");
  burgerMenu.addEventListener('click', () => {
    burgerMenu.classList.toggle('is-active');
    menu.classList.toggle('flex');
    menu.classList.toggle('hidden');
  });
}
function roomTypeSelect() {
  let selectionContainer = document.getElementById('selection-container');
  let select = document.getElementById('select');
  let list = document.getElementById('list');
  let types = document.getElementById('types').children;
  let selectedTypeView = document.getElementById('selected-type-view');
  let selectedTypeValue = document.getElementById('selected-type-value');
  let suit = `<div class="flex justify-center flex-col" id="suit-div">
                    <button id="suit-select" type="reset" class="relative flex justify-between items-center bg-slate-400 border focus:outline-none shdow text-slate-50 rounded focus:ring ring-slate-900 w-48 ">
                        <input type="text" id="selected-suit-value" name="suit-type" class="hidden">
                        <p id="selected-suit-view" class="px-4 cursor-pointer">Select suit type</p>
                        <span class="border-l p-2">
                            <svg  class="w-5 h-5"
                            fill="#1e293b" height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330.002 330.002" xml:space="preserve" transform="rotate(180)" stroke="#1e293b"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_105_" d="M324.001,209.25L173.997,96.75c-5.334-4-12.667-4-18,0L6.001,209.25c-6.627,4.971-7.971,14.373-3,21 c2.947,3.93,7.451,6.001,12.012,6.001c3.131,0,6.29-0.978,8.988-3.001L164.998,127.5l141.003,105.75c6.629,4.972,16.03,3.627,21-3 C331.972,223.623,330.628,214.221,324.001,209.25z"></path> </g>
                            </svg>
                        </span>
                        <div id="suit-list" class="absolute hidden  top-full min-w-full w-max bg-secondary shadow-md mt-1 rounded">
                            <ul id="suit-types" class="text-left border rounded">
                                <li class="px-4 py-1 hover:bg-slate-900 border-b rounded cursor-pointer">Standard</li>
                                <li class="px-4 py-1 hover:bg-slate-900 border-b rounded cursor-pointer">Junior</li>
                                <li class="px-4 py-1 hover:bg-slate-900 border-b rounded cursor-pointer">Presidential</li>
                                <li class="px-4 py-1 hover:bg-slate-900 border-b rounded cursor-pointer">Penthouse</li>
                                <li class="px-4 py-1 hover:bg-slate-900 border-b rounded cursor-pointer">Honeymoon</li>
                                <li class="px-4 py-1 hover:bg-slate-900 border-b rounded cursor-pointer">Bridal</li>
                            </ul>
                        </div>
                    </button>
                </div>`;
  select.addEventListener('click', () => {
    list.classList.toggle('hidden');
  });
  let count = 0;
  for (let i = 0; i < types.length; i++) {
    types[i].addEventListener('click', setType);
  }
  function setType(event) {
    for(let i = 0; i < types.length; i++) {
      types[i].classList.remove('hidden');
    }
    let choice = event.target.innerHTML;
    event.target.classList.add('hidden');
    selectedTypeView.innerHTML = choice;
    selectedTypeValue.value = choice;
  
    if (choice == 'Suit' && count <= 0) {
      let suitContainer = document.createElement('div');
      suitContainer.innerHTML = suit;
      selectionContainer.append(suitContainer); count++;
      suitTypeSelect();
    } else if (count >= 1) {
      document.getElementById('suit-div').parentElement.remove(); count--;
    }

  }
}
function suitTypeSelect() {
  let suitSelect = document.getElementById('suit-select');
  let suitList = document.getElementById('suit-list');
  let suitTypes = document.getElementById('suit-types').children;
  let selectedSuitView = document.getElementById('selected-suit-view');
  let selectedSuitValue = document.getElementById('selected-suit-value');
  suitSelect.addEventListener('click', () => {
    suitList.classList.toggle('hidden');
  });
  for (let i = 0; i < suitTypes.length; i++) {
    suitTypes[i].addEventListener('click', setSuitType);
  }
  function setSuitType(event) {
    let choice = event.target.innerHTML;
    selectedSuitView.innerHTML = choice;
    selectedSuitValue.value = choice;
  }
}

