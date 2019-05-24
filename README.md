# Customer tracking

When customer write his phone number, we will create record in table with the number and empty data. 
Before response sent, we save all tracked data in record, then send response with specific cookie key. 
When customer write his data (such as name or city) next time, we will update data in record.