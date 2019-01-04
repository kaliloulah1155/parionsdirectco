 <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item">
                           <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        	 href="{{ route('dashboard') }}" aria-expanded="false">
                        	 <i class="mdi mdi-view-dashboard"></i>
	                        	 <span class="hide-menu">
	                        	 DASHBOARD
	                        	</span>
                        	</a>
                        </li>
                        <li class="sidebar-item"><a class="sidebar-link has-arrow waves-effect waves-dark sidebar-link" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-eye"></i><span class="hide-menu">ADMINISTRATION</span>
                         </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    @can('Gestion de profil')
                                    <a  class="sidebar-link has-arrow waves-effect waves-dark " href="javascript:void(0)"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Gestion de profil</span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                        @can('Création de profil')
                                        <li class="sidebar-item"><a href="{{route('add_role') }}" class="sidebar-link"><i class="mdi "></i><span class="hide-menu">Création de profil </span></a></li>
                                        @endcan
                                        <li class="sidebar-item"><a href="{{route('voir_role') }}" class="sidebar-link"><i class="mdi "></i><span class="hide-menu">Liste des profils </span></a></li>
                                    </ul>
                                    @endcan
                                </li>
                                <li class="sidebar-item">
                                    @can('Gestion des utilisateurs')
                                    <a  class="sidebar-link has-arrow waves-effect waves-dark " href="javascript:void(0)"><i class="mdi  mdi-account-plus"></i><span class="hide-menu">Gestion des utilisateurs</span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                        @can("Créer utilisateur")
                                        <li class="sidebar-item"><a href="{{route('add_user') }}" class="sidebar-link"><i class="mdi "></i><span class="hide-menu">Création d'utilisateur </span></a></li>
                                        @endcan
                                        <li class="sidebar-item"><a href="{{route('voir_user') }}" class="sidebar-link"><i class="mdi "></i><span class="hide-menu">Liste des utilisateurs </span></a></li>
                                    </ul>
                                    @endcan
                                </li>
                            {{--   @can('Associer un profil et un compte')
                                <li class="sidebar-item"><a href="{{route('add_droit') }}" class="sidebar-link"><i class="mdi  mdi-account-key"></i><span class="hide-menu">Gestion des droits</span></a></li>
                                @endcan--}} 
                                @can("piste d'audits")
                                <li class="sidebar-item"><a href="{{route('audits') }}"  class="sidebar-link"><i class="mdi  mdi-account-network"></i><span class="hide-menu">Piste d'audits</span></a></li>
                                @endcan
                            </ul>
                        </li>
                        @can('Liste des joueurs')
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"  href="{{route('players_list') }}"  aria-expanded="false"><i class="mdi mdi-clipboard-account"></i><span class="hide-menu">LISTE DES JOUEURS</span></a></li>
                        @endcan
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">LISTE DES TICKETS PRIS </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                @can('Jeux Digitaux')
                                <li class="sidebar-item"><a  href="{{route('jeuxdigitaux') }}" class="sidebar-link"><i class="mdi mdi-screen-rotation"></i><span class="hide-menu"> Jeux digitaux </span></a></li>
                                @endcan
                                @can('LOTO')
                                <li class="sidebar-item"><a href="{{route('lotobonheur') }}" class="sidebar-link"><i class="mdi  mdi-run"></i><span class="hide-menu"> Loto bonheur </span></a></li>
                                @endcan
                                @can('PMU ALR')
                                <li class="sidebar-item"><a  href="{{route('pmualr') }}" class="sidebar-link"><i class="mdi mdi-lightbulb-outline"></i><span class="hide-menu"> PMU ALR </span></a></li>
                               @endcan
                               @can('PMU PLR')
                                <li class="sidebar-item"><a href="{{route('pmuplr') }}" class="sidebar-link"><i class="mdi  mdi-readability"></i><span class="hide-menu"> PMU PLR </span></a></li>
                               @endcan
                               @can('SPORTCASH')
                                <li class="sidebar-item"><a  href="{{route('sportcash') }}" class="sidebar-link"><i class="mdi mdi-recycle"></i><span class="hide-menu"> SPORTCASH </span></a></li>
                               @endcan
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">EN ATTENTE DE PAIEMENT</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                @can('Liste des paiements validés')
                                <li class="sidebar-item"><a href="{{route('paiementvalide') }}" class="sidebar-link"><i class="mdi  mdi-cash-usd"></i><span class="hide-menu">Liste des paiements validés</span></a></li>
                                @endcan
                                @can('LOTO')
                                <li class="sidebar-item"><a href="{{route('atlotobonheur') }}" class="sidebar-link"><i class="mdi mdi-run"></i><span class="hide-menu">Loto bonheur</span></a></li>
                                @endcan
                                @can('PMU ALR')
                                <li class="sidebar-item"><a href="{{route('atpmualr') }}" class="sidebar-link"><i class="mdi mdi-lightbulb-outline"></i><span class="hide-menu">PMU ALR</span></a></li>
                                @endcan
                                @can('PMU PLR')
                                <li class="sidebar-item"><a href="{{route('atpmuplr') }}" class="sidebar-link"><i class="mdi mdi-readability"></i><span class="hide-menu">PMU PLR</span></a></li>
                                @endcan
                                @can('SPORTCASH')
                                <li class="sidebar-item"><a href="{{route('atsportcash') }}" class="sidebar-link"><i class="mdi mdi-recycle"></i><span class="hide-menu">SPORTCASH</span></a></li>
                                @endcan
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">TICKETS GAGNANTS</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                @can('Gagnants de jeux')
                                <li class="sidebar-item"><a href="{{route('gagnantsjeux') }}" class="sidebar-link"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu">Gagnants de jeux</span></a></li>
                                @endcan
                                @can('LOTO')
                                <li class="sidebar-item"><a href="{{route('galotobonheur') }}" class="sidebar-link"><i class="mdi mdi-run"></i><span class="hide-menu">Loto bonheur</span></a></li>
                                @endcan
                                @can('PMU ALR')
                                <li class="sidebar-item"><a href="{{route('gapmualr') }}" class="sidebar-link"><i class="mdi mdi-lightbulb-outline"></i><span class="hide-menu">PMU ALR</span></a></li>
                                @endcan
                                @can('PMU PLR')
                                <li class="sidebar-item"><a href="{{route('gapmuplr') }}" class="sidebar-link"><i class="mdi mdi-readability"></i><span class="hide-menu">PMU PLR</span></a></li>
                                @endcan
                                @can('SPORTCASH')
                                <li class="sidebar-item"><a href="{{route('gasportcash') }}" class="sidebar-link"><i class="mdi mdi-recycle"></i><span class="hide-menu">SPORTCASH</span></a></li>
                                @endcan
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-message"></i><span class="hide-menu">MESSAGERIES</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                               

                                 <li class="sidebar-item">
                                    <a  class="sidebar-link has-arrow waves-effect waves-dark " href="javascript:void(0)"><i class="mdi mdi-message-bulleted"></i><span class="hide-menu">SMS</span></a>
                                    <ul aria-expanded="false" class="collapse  first-level">
                                       
                                            <li class="sidebar-item"><a  href="{{route('getsms') }}" class="sidebar-link"><i class=""></i><span class="hide-menu">Envoi</span></a></li>
                                       
                                            <li class="sidebar-item"><a  href="{{route('getsmshistoric') }}" class="sidebar-link"><i class=""></i><span class="hide-menu">Historiques</span></a></li>
                                       
                                    </ul>
                                </li>

                                <li class="sidebar-item">
                                    <a  class="sidebar-link has-arrow waves-effect waves-dark " href="javascript:void(0)"><i class="mdi mdi-folder"></i><span class="hide-menu">E-MAIL</span></a>
                                      <ul aria-expanded="false" class="collapse  first-level">
                                       @can('Envoi de message')
                                            <li class="sidebar-item"><a  href="{{route('smscontent') }}" class="sidebar-link"><i class=""></i><span class="hide-menu">Envoi</span></a></li>
                                        @endcan
                                        @can('Historique des messages envoyés')
                                            <li class="sidebar-item"><a  href="{{route('smshistoric') }}" class="sidebar-link"><i class=""></i><span class="hide-menu">Historiques</span></a></li>
                                        @endcan
                                    </ul>
                                </li>


                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
 </aside>
