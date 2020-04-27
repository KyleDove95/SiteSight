ALTER TABLE `SS_tags`
  ADD CONSTRAINT `SS_tags_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `SS_users` (`userID`) ON DELETE CASCADE
  
ALTER TABLE `SS_tiles`
  ADD CONSTRAINT `SS_tiles_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `SS_users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `SS_tiles_ibfk_2` FOREIGN KEY (`tag_name`) REFERENCES `SS_tags` (`tag_name`) ON DELETE CASCADE;