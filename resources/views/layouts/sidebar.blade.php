<div class="sidebar">
    
    <nav class="nav navbar-dark flex-column">
        @if (Auth::user()->role == 'admin')
            <h4>Admin</h4>
            <a class="nav-link active text-white" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="nav-link" href="{{ route('admin.manage-campaigns') }}">Manage Campaigns</a>
            <a class="nav-link" href="{{ route('admin.manage-users') }}" >Manage Users</a>
        @elseif (Auth::user()->role == 'project_owner')
            <h4>Project owner</h4>
            <a class="nav-link active text-white" href="{{ route('project_owner.dashboard') }}">Dashboard</a>
            <a class="nav-link" href="{{ route('project_owner.my-campaigns') }}">Manage Campaigns</a>
            <a class="nav-link" href="{{ route('project_owner.create-campaign') }}">Add new campaign</a>
        @elseif (Auth::user()->role == 'contributor')
            <h4>Contributor</h4>
            <a class="nav-link active text-white" href="{{ route('contributor.dashboard') }}">Dashboard</a>
            <a class="nav-link" href="{{ route('contributor.contributions') }}">My Contributions</a>
            <a class="nav-link" href="{{ route('campaigns') }}">Campaings</a>
        @endif
       
        {{-- <a class="nav-link" href="#">Analytics</a> --}}
        <a class="nav-link" href="{{ route('profile.edit') }}">Settings</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
        </form>
    </nav>
</div>
{{-- <style>
       body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
    }
    .wrapper {
        display: flex;
        flex: 1;
    }
    .sidebar {
        width: 250px;
        background: #f8f9fa;
        padding: 15px;
    }
    .sidebar .nav-link {
        color: #333;
    }
    .sidebar .nav-link.active {
        background: #007bff;
        color: white;
    }
    .content {
        flex: 1;
        padding: 20px;
    }
    .card-stats {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }
    .card-stats .card {
        flex: 1;
        margin: 0 10px;
        text-align: center;
    }
</style> --}}

<style>
    body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
    }
    .wrapper {
        display: flex;
        flex: 1;
    }
    .sidebar {
        width: 250px;
        background: #343a40; /* Dark background */
        padding: 15px;
        color: white
    }
    .sidebar .nav-link {
        color: #fff; /* White text */
    }
    .sidebar .nav-link.active {
        background: #007bff; /* Active link background */
        color: white;
    }
    .sidebar .nav-link:hover {
        background: #495057; /* Hover background */
        color: white;
    }
    .content {
        flex: 1;
        padding: 20px;
    }
    .card-stats {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }
    .card-stats .card {
        flex: 1;
        margin: 0 10px;
        text-align: center;
    }
    .dropdown-item {
        color: white; /* Ensure dropdown items have white text */
    }
    .dropdown-item:hover {
        background: #495057; /* Hover background for dropdown items */
    }
</style>
