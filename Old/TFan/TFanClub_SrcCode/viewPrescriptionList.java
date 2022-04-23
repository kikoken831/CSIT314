package tFanClubProject;


import java.awt.EventQueue;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.border.EmptyBorder;
import javax.swing.SwingConstants;
import javax.swing.JTable;

import net.miginfocom.swing.MigLayout;

import javax.swing.JTextField;
import javax.swing.JLabel;
import javax.swing.JOptionPane;

public class viewPrescriptionList extends JFrame 
{

	private JPanel contentPane;
	private JTable table;
	private JButton btnNewButton;
	private JTextField textField;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() 
		{
			public void run() 
			{
				try 
				{
					String username = null;
					viewPrescriptionList frame = new viewPrescriptionList(username);
					frame.setVisible(true);
				} catch (Exception e) 
				{
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public viewPrescriptionList(String username) 
	{
		
		String accountUsername = username;
		
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 646, 376);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(new MigLayout("", "[55px,grow][][grow][][][][][][][][][][][][][][][][][][][][]", "[23px][grow][][][][][][][][][][][][][][]"));
		
		viewPrescriptionListController vPLC = new viewPrescriptionListController(); 
		
		// User Info label
		String fullName = vPLC.passPatientFullName(username);
		JLabel lblNewLabel_1 = new JLabel("Patient:");
		contentPane.add(lblNewLabel_1, "flowx,cell 9 2");
		
		// Logout button
		JButton btnLogout = new JButton("Logout");
		btnLogout.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				JFrame loginPage = new LoginPage();
				loginPage.setVisible(true);
				
				dispose();
			}
		});
		
		// Back button to return to homepage
		JButton btnHome = new JButton("Home");
		btnHome.setHorizontalAlignment(SwingConstants.RIGHT);
		btnHome.addActionListener(new ActionListener() 
		{
			public void actionPerformed(ActionEvent e) 
			{
				JFrame homepage = new homePagePatient(accountUsername);
				homepage.setVisible(true);
				dispose();
			}
		});
		contentPane.add(btnHome, "cell 20 2,alignx left,aligny top");
		btnLogout.setBounds(335, 11, 89, 23);
		contentPane.add(btnLogout, "cell 21 2");
		
		// Search bar
		JLabel lblNewLabel = new JLabel("Prescription ID: ");
		contentPane.add(lblNewLabel, "flowx,cell 9 5");
		textField = new JTextField();
		contentPane.add(textField, "cell 9 5,alignx left");
		textField.setColumns(10);
		JButton btnSearch = new JButton("Search");
		contentPane.add(btnSearch, "cell 9 5");
		btnSearch.addActionListener(new ActionListener() 
		{
			public void actionPerformed(ActionEvent e) 
			{if (textField.getText().isEmpty())
			{
				JOptionPane.showMessageDialog(null, "Please key in the prescription ID");			
			}
			else
			{
				try
				{
					int prescriptionID = Integer.parseInt(textField.getText());

					if(vPLC.checkPrescription(username, prescriptionID) == false)
					{
						JOptionPane.showMessageDialog(null, "The prescription ID entered does not belong to you or doesn't exist.");	
					}
					else 
					{
						JFrame viewPrescription = new viewPrescription(username, prescriptionID);
						viewPrescription.setVisible(true);
						dispose();	
					}
				}
				catch (NumberFormatException a)
				{
					JOptionPane.showMessageDialog(null, "Please enter an integer for the ID.");	
				}
			}
			} 
		});
		
		getTable(accountUsername,fullName);
	}
	
	public void getTable(String accountUsername,String fullName)
	{
		// Prescription table
				viewPrescriptionListController vPLC = new viewPrescriptionListController();
				String [] columnNames = {"Prescription ID", "Prescribed date", "Prescribed status"};
				String [][] data = vPLC.getPrescriptions(accountUsername);
				
				table = new JTable(data, columnNames){

			        @Override
			        public boolean isCellEditable(int row, int column)
			        {
			            // make read only fields except column 0,13,14
			            return column == 0 || column == 13 || column == 14;
			        }
			    };
				
				table.getColumnModel().getColumn(0).setPreferredWidth(100);
				table.getColumnModel().getColumn(1).setPreferredWidth(100);
			
				JScrollPane scrollPane = new JScrollPane(table);
				scrollPane.setEnabled(false);
				contentPane.add (scrollPane, "flowx,cell 9 10");
				JLabel lblNewLabel_2 = new JLabel(fullName);
				contentPane.add(lblNewLabel_2, "cell 9 2 1 2");
	}
}
	


