
let buttons = document.querySelectorAll('.custom-control-input');
buttons.forEach((elem) => {
    elem.addEventListener('change', () => {
        let id = elem.getAttribute('data-id');
        let is_admin = elem.checked;
        (
            async () => {
                const response = await fetch('/admin/users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        id: id,
                        is_admin: is_admin
                    })
                });
                const answer = await response.json();
                console.log(answer);
            }
        )();
    })
});