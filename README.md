# Printful

Recruitment task

## Run

Run project using make command:

```bash  
 make run  
```  
this command will start project in docker containers.

```bash  
 make down  
```  
this command will stop project and remove all docker containers

## Perform
To run script and send request to PrintfulAPI you need to run make command:
```bash  
 make request  
``` 
or enter docker container:
```bash  
 make bash  
```  
and then simply run in terminal: 
```bash  
 php bin/StartCommand.php  
```  

After running this command you will see the result:
```bash  
{"colors":["Black","Dark Heather","Navy","Sport Grey","White"]}
{"sizes":["S","M","L","XL","2XL","3XL"]}
```  

## Test
To test project, simply run:
```bash
 make test 
```  
This command performs all unit tests within project.

## Authors

- [@krzysztof heigel](https://github.com/kfheigel)