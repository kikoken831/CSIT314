package tFanClubProject;

public class homePageAdminController {

	UserInfo user = new UserInfo();

	public String passAdminHomepageInfo (String fullname) {
		
		String result = null;
		
		result  = user.getHomepageInfo(fullname);
		
		return result;
	}
	
	public String passUsername(int ID, int userType) {
		Admin admin = new Admin();
		String username = null;
		switch(userType) {
		
		case 0:
			username = admin.getAdminUsername(ID);
			break;
		case 1:
			username = admin.getDoctorUsername(ID);
			break;
		case 2:
			username = admin.getPatientUsername(ID);
			break;
		case 3:
			username = admin.getPharmacistUsername(ID);
			break;
		}
		
		return username;
	}
}
