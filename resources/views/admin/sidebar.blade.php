
        <div class="col-2 ml-5">
            <div class="card">
                <div class="card-body" style="text-align:center;background-color: #f2f2f2;font-weight:600">
                    <h4 style="font-weight:600;">User Manage</h4>
                    <hr>
                <a href="{{ route('admin.userDetail') }}" style="text-decoration:none;font-size:18px;">User Detail</a><br/>
                <a href="{{ route('admin.consultantDetail') }}" style="text-decoration:none;font-size:18px">Consultant Detail</a><br/>
                    <a href="{{ route('admin.organizerDetail') }}" style="text-decoration:none;font-size:18px">Oragnizer Detail</a><br/>
                    
                    <h4 style="font-weight:600;margin-top:10px">Transaction Manage</h4>
                    <hr>
                <a href="{{route('admin.courseTransaction')}}" style="text-decoration:none;font-size:17px">Online Course Transaction</a><br/>
                    <a href="{{route('admin.documentTransaction')}}" style="text-decoration:none;font-size:17px">Document Transaction</a><br/>
                <a href="{{route('admin.questionTransaction')}}" style="text-decoration:none;font-size:17px">Bounty Question Transaction</a><br/>

                    <h4 style="font-weight:600;margin-top:10px">Request Manage</h4>
                    <hr>
                    <a href="{{route('admin.consultantRequest')}}" style="text-decoration:none;font-size:18px">Consultant Request</a><br/>
                <a href="{{ route('admin.organizerRequest') }}" style="text-decoration:none;font-size:18px">Organizer Request</a><br/>

                    <h4 style="font-weight:600;margin-top:10px">Report Manage</h4>
                    <hr>
                <a href="{{route('admin.reportPost')}}" style="text-decoration:none;font-size:18px">Post Report</a><br/>
                <a href="{{route('admin.reportDocument')}}" style="text-decoration:none;font-size:18px">Document Report</a><br/>
                </div>
            </div>
        </div>
        
  

    


