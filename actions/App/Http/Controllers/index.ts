import HomeController from './HomeController'
import TourPackageController from './TourPackageController'
import Admin from './Admin'
import Settings from './Settings'
import Teams from './Teams'

const Controllers = {
    HomeController: Object.assign(HomeController, HomeController),
    TourPackageController: Object.assign(TourPackageController, TourPackageController),
    Admin: Object.assign(Admin, Admin),
    Settings: Object.assign(Settings, Settings),
    Teams: Object.assign(Teams, Teams),
}

export default Controllers