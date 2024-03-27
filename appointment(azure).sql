CREATE TABLE appointment (
  id INT PRIMARY KEY IDENTITY(1,1),
  YName NVARCHAR(50) NOT NULL,
  YNumber BIGINT NOT NULL,
  YEmail NVARCHAR(50) NOT NULL,
  YDate DATE NOT NULL
);

INSERT INTO appointment (YName, YNumber, YEmail, YDate) 
VALUES ('swapnil', 8108372972, 'pawarswapnil98505@gmail.com', '2023-04-13');
