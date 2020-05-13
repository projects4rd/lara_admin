<script type="application/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

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
