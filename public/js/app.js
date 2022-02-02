let lists = document.querySelectorAll('.list');
let sublinks = document.querySelectorAll('.sub-links');

function closeLists(){
  lists.forEach(list => {
    list.classList.remove('open-list');
  });
  sublinks.forEach(sublink => {
    sublink.classList.remove('open-sub-links');
  });
}
