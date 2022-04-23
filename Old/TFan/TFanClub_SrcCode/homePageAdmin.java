package tFanClubProject;

import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.awt.event.ActionEvent;
import net.miginfocom.swing.MigLayout;
import javax.swing.JTextField;
import javax.swing.JComboBox;
import javax.swing.DefaultComboBoxModel;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;

public class homePageAdmin extends JFrame {

	private JPanel contentPane;
	private JTextField textFieldIDSearch;
	//For combobox
	int whichUser = 0;
	private JTextField textFieldUsernameAnswer;


	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					String username = null;
					homePageAdmin frame = new homePageAdmin(username);
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	//LoginPage passes in the username
	public homePageAdmin(String username) {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(new MigLayout("", "[][262px,grow][][][89px,grow]", "[35px][23px][][][][][]"));
		
		JLabel lblWelcome = new JLabel("New label");
		contentPane.add(lblWelcome, "cell 1 0,grow");
		
		JButton btnLogout = new JButton("Logout");
		btnLogout.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				JFrame loginPage = new LoginPage();
				loginPage.setVisible(true);
				
				dispose();
			}
		});
		
		//Goes to add user page
		JButton btnAddUser = new JButton("Add/Update");
		btnAddUser.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				JFrame adduserpage = new addUserAdmin(username);
				
				adduserpage.setVisible(true);
				dispose();
			}
		});
		contentPane.add(btnAddUser, "cell 3 0,alignx left,aligny center");
		contentPane.add(btnLogout, "cell 4 0,growx,aligny center");
		
		//Set username to Jlabel
		homePageAdminController adminController = new homePageAdminController();
		String fullName = adminController.passAdminHomepageInfo(username);
		lblWelcome.setText("Welcome Admin, " + fullName);
		
		JComboBox comboBoxSelect = new JComboBox();
		comboBoxSelect.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				whichUser = comboBoxSelect.getSelectedIndex();
			}
		});
		comboBoxSelect.setModel(new DefaultComboBoxModel(new String[] {"Admin", "Doctor", "Patient", "Pharmacist"}));
		contentPane.add(comboBoxSelect, "cell 3 2,alignx left");
		
		textFieldIDSearch = new JTextField();
		textFieldIDSearch.addKeyListener(new KeyAdapter() {
			@Override
			public void keyReleased(KeyEvent e) {
				int userID = 0;
				try {
				userID = Integer.valueOf(textFieldIDSearch.getText());
				} catch(Exception f){
					
				}
				homePageAdminController controller = new homePageAdminController();
				String username = controller.passUsername(userID, whichUser);
				textFieldUsernameAnswer.setText(username);
			}
		});
		
		JLabel lblNewLabel = new JLabel("Search ID : ");
		contentPane.add(lblNewLabel, "cell 1 3,alignx right");
		contentPane.add(textFieldIDSearch, "cell 3 3,growx");
		textFieldIDSearch.setColumns(10);
		
		JLabel lblUsername = new JLabel("Username : ");
		contentPane.add(lblUsername, "cell 1 4,alignx trailing");
		
		textFieldUsernameAnswer = new JTextField();
		textFieldUsernameAnswer.setEditable(false);
		contentPane.add(textFieldUsernameAnswer, "cell 3 4,growx");
		textFieldUsernameAnswer.setColumns(10);
		


		
		
		
		
	}
}
