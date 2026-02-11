<div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <NavLink href={route('dashboard')} active={route().current('dashboard')}>
        Dashboard
    </NavLink>
    
    {/* Kani waa kan aad hadda ku dartay */}
    <NavLink href={route('students.index')} active={route().current('students.*')}>
        Students
    </NavLink>
</div>