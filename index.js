console.log('Welcome');
let alerts = document.getElementsByClassName('hataAlert');
Array.from(alerts).forEach((eachAlert) => {
    setTimeout(() => {
        eachAlert.style.display = 'none';
    }, 1000);
});

// ENABLING DARK AND LIGHT MODE
let sun = document.getElementById('sun');
let moon  = document.getElementById('moon');
let dark = document.getElementById('dark');
let light = document.getElementById('light');

// Default Mode

let defaultMode = localStorage.getItem('mode');
if(defaultMode == 'light'){
    // ENABLING DEFAULT LIGHT MODE
    moon.style.display = 'block';
    sun.style.display = 'none';
    dark.style.display = 'block';
    light.style.display = 'none';

    let allElements = document.getElementsByClassName('backDark');
    let allElements_Array = Array.from(allElements);
    allElements_Array.forEach((each)=>{
        each.classList.remove('backDark');
        each.classList.add('backLight');
    })
}
else if(defaultMode == 'dark'){
    // ENABLING DEFAULT DARK MODE
    moon.style.display = 'none';
    sun.style.display = 'block';
    dark.style.display = 'none';
    light.style.display = 'block';

    let allElements = document.getElementsByClassName('backLight');
    let allElements_Array = Array.from(allElements);
    allElements_Array.forEach((each)=>{
        each.classList.remove('backLight');
        each.classList.add('backDark');
    })
}


// Dark Mode will be enabled
moon.addEventListener('click', ()=>{
    moon.style.display = 'none';
    sun.style.display = 'block';

    light.style.display = 'block';
    dark.style.display = 'none';

    let allElements = document.getElementsByClassName('backLight');
    let allElements_Array = Array.from(allElements);

    allElements_Array.forEach((each)=>{
        each.classList.remove('backLight');
        each.classList.add('backDark');
    })

    localStorage.setItem('mode', 'dark');
})

// Light Mode will be enabled
sun.addEventListener('click', ()=>{
    sun.style.display = 'none';
    moon.style.display = 'block';

    light.style.display = 'none';
    dark.style.display = 'block';

    let allElements = document.getElementsByClassName('backDark');
    let allElements_Array = Array.from(allElements);

    allElements_Array.forEach((each)=>{
        each.classList.remove('backDark');
        each.classList.add('backLight');
    })

    localStorage.setItem('mode', 'light');
})