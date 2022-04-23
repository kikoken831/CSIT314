package tFanClubProject;

public class LoginPageController {
	
	UserInfo user = new UserInfo();

	public String passUserInfo (String username, char[] password) {
		
		String role = user.validateInfo(username, password);
		return role;

	}
	
}
