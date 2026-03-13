<nav id="nav">
    <ul>
        <li class="special">
            <a href="#menu" class="menuToggle"><span>Menu</span></a>
            <div id="menu">
                <ul>
                    <li><a href="{url action='showMainPage'}">Strona główna</a></li>
                    {if \core\RoleUtils::inRole("admin")}
                        <li><a href="{url action='showReceptionistsMan'}">Recepcjoniści</a></li>
                        <li><a href="{url action='showPatientsMan'}">Pacjenci</a></li>
                    {elseif \core\RoleUtils::inRole("receptionist")}
                        <li><a href="{url action='showSchedule'}">Harmonogram</a></li>
                        <li><a href="{url action='showPatientsMan'}">Pacjenci</a></li>
                        <li><a href="{url action='showDoctorsMan'}">Lekarze</a></li>
                        <li><a href="{url action="showPredefinedVisitReasonsMan"}">Predefiniowane przyczyny wizyt</a></li>
                    {elseif \core\RoleUtils::inRole('patient')}
                        <li><a href="{url action='showSchedule'}">Moje wizyty</a></li>
                        <li><a href="{url action="showDoctorsGrid"}">Umów wizytę</a></li>
                    {/if}

                    {if \core\RoleUtils::inAnyRole()}
                        <li><a href="{url action='showMyAccount'}">Moje konto</a></li>
                        <li><a href="{url action="logout"}">Wyloguj</a></li>
                    {else}
                        <li><a href="{url action="login"}">Zaloguj</a></li>
                        <li><a href="{url action="showDoctorsGrid"}">Nasi Lekarze</a></li>
                    {/if}
                </ul>
            </div>
        </li>
    </ul>
</nav>