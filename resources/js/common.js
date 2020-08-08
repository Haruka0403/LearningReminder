'use strict';

  {
    const open = document.getElementById('open');
    const make = document.getElementById('make');
    const modal = document.getElementById('modal');
    const mask = document.getElementById('mask');
    
  
    open.addEventListener('click', () => {
      modal.classList.remove('hidden');
      mask.classList.remove('hidden');
    });
    
    make.addEventListener('click', () => {
      modal.classList.add('hidden');
      mask.classList.add('hidden');
    });
    
     mask.addEventListener('click', () => {
      // modal.classList.add('hidden');
      // mask.classList.add('hidden');
      make.click();
     });
  }