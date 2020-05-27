<script src="{{ asset('js/app.js') }}"></script>

<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/af-2.3.5/b-1.6.2/b-colvis-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.2/r-2.2.4/rg-1.1.2/rr-1.2.7/sc-2.0.2/sp-1.1.0/sl-1.3.1/datatables.min.js"></script>

<script type="application/javascript">
    document.addEventListener('DOMContentLoaded', function() {

        const dismiss = document.getElementById('dismiss');
        dismiss.addEventListener('click', function(){
            document.getElementById('sidebar').classList.remove('active');
        });

        // const overlay = document.querySelector('.overlay');
        // overlay.addEventListener('click', function(){
        //     overlay.classList.remove('active');
        // });

        document.getElementById('sidebarCollapse').addEventListener('click', function(e){
            e.stopImmediatePropagation();

            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('navbar').classList.toggle('active');
            document.getElementById('content').classList.toggle('active');
            //document.querySelector('.collapse.in').classList.toggle('in');
        });
    });

</script>
