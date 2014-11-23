package com.Xconvert.jobs;

import java.io.File;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Date;

import org.quartz.Job;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.apache.log4j.Logger;
import java.text.SimpleDateFormat;
import com.Xconvert.Main;

public class JobDaemon implements Job{
	
	static Logger log = Logger.getLogger(
			 Main.class.getName());

	@Override
	public void execute(JobExecutionContext jec) throws JobExecutionException {
		// TODO Auto-generated method stub
		log.info("Checking database for pending jobs");
		
		  String myDriver = "com.mysql.jdbc.Driver";
	      String myUrl = "jdbc:mysql://localhost/edplayground";
	      java.sql.Statement stmtSelect;
	      java.sql.Statement stmtUpdate;
	      ResultSet rs;
	      Convert c;
	      try {
	    	 
	    	Class.forName(myDriver);
			java.sql.Connection conn = DriverManager.getConnection(myUrl, "root", "secretpassword");
			
			stmtSelect = conn.createStatement() ;
			stmtUpdate = conn.createStatement() ;
			
			String selectQuery = "Select * from encodingJobs where status = 'pending' limit 3" ;
			  rs = stmtSelect.executeQuery(selectQuery) ;
		
			while (rs.next()){
		        int jobId = rs.getInt("job_id");
		        String source = rs.getString("source");
		        String destination = rs.getString("destination");
		        String thumbnail1 = rs.getString("thumbnail1");
		        Date dateCreated = rs.getDate("created");
		        String status  = rs.getString("status");
		        String command  = rs.getString("command");
		        int video_id = rs.getInt("video_id");
		        
		        log.info("Found pending job "+jobId);
		    
		        
				if (status.equalsIgnoreCase("pending")) {
					String updateQuery = "UPDATE  `edplayground`.`encodingJobs` SET  `status` =  'processing' WHERE  `encodingJobs`.`job_id` = "
							+ jobId;
					log.debug(updateQuery);
					
					stmtUpdate.executeUpdate(updateQuery);

					c = new Convert(jobId, video_id, source, destination,thumbnail1);
					Boolean convertionRes = c.startConvert();
                    
		 			if (convertionRes) {
						stmtUpdate
								.executeUpdate("UPDATE  `edplayground`.`encodingJobs` SET  `status` =  'completed' WHERE  `encodingJobs`.`job_id` = "
										+ jobId);
						
						
						log.debug("Creating thumbnail...."); 
						log.debug("Thumbnail Created...."+c.createThumbnail()); 
						log.debug("Deleting original file...");
						new File(source).delete();
					}

				} 
		        
			}
			stmtSelect.close();
            log.debug("closing connection...");  
			  
		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	     
	}

}
