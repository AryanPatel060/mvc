
document.addEventListener('DOMContentLoaded', () => {

    error = false;
    msg = "";
    const name = document.getElementById('name');
    const form = document.getElementById('form');
    const errorDiv = document.getElementById('error');
    const mfgDate = document.getElementById('mfg_date');
    console.log(mfgDate);
    console.log(name);
    name.addEventListener('input', () => {
        console.log(name.value);
        if (name.value == "00") {
            error = true;
            msg = 'vakue is 00';
        }
    })
    mfgDate.addEventListener('change', () => {
        const mDate = new Date(mfgDate.value);
        const today = new Date();
    
        if (mDate > today) {
            msg = "manufacutring date is invalid !";
            error = true; 
        }
        else 
        {
            msg = '';
            error = false;
        }
        console.log(mDate || 'name');
    })
    
    

    form.addEventListener('submit', (e) => {
        if (error) {
            e.preventDefault();
            errorDiv.textContent = msg;
        }
    })
})

